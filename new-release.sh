#!/bin/bash

YELLOW='\033[0;33m'
GREEN='\033[0;32m'
LIGHT_BLUE='\033[1;34m'
LIGHT_CORAL='\033[1;31m'
NC='\033[0m'

if [ $# -eq 0 ]; then
  printf "${LIGHT_CORAL}No arguments provided${LIGHT_CORAL}. Please use ${YELLOW}major${LIGHT_CORAL}, ${YELLOW}minor${LIGHT_CORAL}, or ${YELLOW}patch${LIGHT_CORAL}.${NC}\n"
  exit 0
fi

if [ "$1" != "major" ] && [ "$1" != "minor" ] && [ "$1" != "patch" ]; then
  printf "${LIGHT_CORAL}Invalid argument: ${YELLOW}%s${LIGHT_CORAL}. Please use ${YELLOW}major${LIGHT_CORAL}, ${YELLOW}minor${LIGHT_CORAL}, or ${YELLOW}patch${LIGHT_CORAL}.${NC}\n" "$1"
  exit 1
fi

INCREMENT_PART=$1
DEFAULT_VERSION="1.0.0"
PRODUCTION_BRANCH="main"

increment_version() {
  local version=$1
  local part=$2
  local clean_version="${version#v}"
  IFS='.' read -ra parts <<<"$clean_version"

  case $part in
  "major")
    ((parts[0]++))
    parts[1]=0
    parts[2]=0
    ;;
  "minor")
    ((parts[1]++))
    parts[2]=0
    ;;
  "patch")
    ((parts[2]++))
    ;;
  *)
    echo "Invalid version part: $part"
    exit 1
    ;;
  esac

  echo "v${parts[0]}.${parts[1]}.${parts[2]}"
}

print_step() {
  printf "\n${LIGHT_BLUE}%b${NC}" "$1"
}

print_success() {
  printf "${GREEN}%b${NC}\n" "$1"
}

print_progress_bar() {
  local progress=$1
  local bar_length=50
  local filled_length=$((progress * bar_length / 100))
  filled_length=$((filled_length > bar_length ? bar_length : filled_length))
  local empty_length=$((bar_length - filled_length))
  local progress_bar="${YELLOW}["
  progress_bar+="$(printf '#%.0s' $(seq 1 "$filled_length"))"
  progress_bar+="$(printf ' %.0s' $(seq 1 "$empty_length"))"
  progress_bar+="]${LIGHT_BLUE} $progress%${NC}"
  printf "\r%b" "$progress_bar"
}

simulate_processing() {
  local seconds=$1
  sleep "$seconds"
}

git_quiet() {
  git "$@" >/dev/null 2>&1
}

push_branch() {
  local branch_name=$1
  local release_tag=$2

  print_step "-> Pushing the new branch to the remote repository...\n"

  git_quiet merge --no-ff "$PRODUCTION_BRANCH"

  git_quiet push origin "$branch_name" \
    -o merge_request.create \
    -o merge_request.label=release \
    -o merge_request.target="$PRODUCTION_BRANCH" \
    -o merge_request.title="RELEASE v$release_tag" \
    -o merge_request.description="New release version $release_tag" \
    -o merge_request.squash=false \
    -o merge_request.remove_source_branch=true &

  local max_time=30
  local progress=0
  local pid=$!
  local start_time=$(date +%s)

  while kill -0 $pid 2>/dev/null; do
    local current_time=$(date +%s)
    local elapsed_time=$((current_time - start_time))
    progress=$((elapsed_time * 100 / max_time))
    progress=$((progress > 100 ? 100 : progress))
    print_progress_bar $progress
    sleep 1
  done

  wait $pid
  print_progress_bar 100
  echo ""
  print_success "<- Pushed at remote repository."
}

print_step "-> Retrieving the last release version from Git tags..."
git_quiet fetch --tags
LAST_TAG=$(git tag -l --sort=v:refname "v*" | tail -n 1 2>/dev/null || echo "$DEFAULT_VERSION")
print_success "\n<- Last release version: ${YELLOW}$LAST_TAG"

print_step "-> Incrementing the version number..."
NEW_TAG=$(increment_version "$LAST_TAG" "$INCREMENT_PART")
NEW_VERSION="${NEW_TAG#v}"
BRANCH_NAME="RELEASE-$NEW_VERSION"
print_success "\n<- New version: ${YELLOW}$NEW_VERSION"

print_step "-> Creating and switching to the release branch: ${YELLOW}$BRANCH_NAME${LIGHT_BLUE}..."
git_quiet checkout -b "$BRANCH_NAME"
print_success "\n<- Branch created: ${YELLOW}$BRANCH_NAME"

push_branch "$BRANCH_NAME" "$NEW_VERSION"

print_step "-> Creating a new tag: ${YELLOW}$NEW_TAG${LIGHT_BLUE}..."
git_quiet tag -a "$NEW_TAG" -m "Release v$NEW_VERSION"
git_quiet push origin "$NEW_TAG"
print_success "\n<- Tag created: ${YELLOW}$NEW_TAG"
2
print_success "\n\nRelease branch ${YELLOW}$BRANCH_NAME${GREEN} and tagged as ${YELLOW}$NEW_TAG${GREEN}."

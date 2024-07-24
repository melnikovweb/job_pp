#!/bin/bash

YELLOW='\033[0;33m'
GREEN='\033[0;32m'
NC='\033[0m'

echo "Installing git hooks..."

declare -a hooks=("pre-commit" "pre-push" "post-merge" "prepare-commit-msg")

for hook in "${hooks[@]}"; do
	hookPath=".git/hooks/$hook"
	scriptPath="./$hook.sh"

	if [[ ! -f $scriptPath ]]; then
		echo -e "${YELLOW}Warning: The script $scriptPath does not exist. Skipping.${NC}"
		continue
	fi

	[[ -L $hookPath ]] && rm "$hookPath"

	ln -s "../../$hook.sh" "$hookPath" && chmod +x "$hook.sh"

	echo -e "${GREEN}Installed and made executable: $hook.sh${NC}"
done

echo -e "${GREEN}All specified git hooks have been successfully installed!${NC}"

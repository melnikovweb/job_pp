# Installation guideline:
# cd ./.git/hooks
# ln -s ../../pre-commit.sh pre-commit && chmod +x pre-commit
# cd ../..

GREEN='\033[0;32m'
YELLOW='\033[0;33m'
NC='\033[0m'

echo "${YELLOW}Running npm run lint:fix...${NC}"

npm run lint:fix

if [ $? -eq 0 ]; then
	echo "${GREEN}Linting and auto-fixing complete. Staging changes...${NC}"

	git add -u

	echo "${GREEN}Changes staged. Ready to commit.${NC}"
else
	echo "${YELLOW}Linting failed. Please fix the errors and try again.${NC}"
	exit 1
fi

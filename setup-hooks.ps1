$YELLOW = "`e[0;33m"
$GREEN = "`e[0;32m"
$NC = "`e[0m"

Write-Host "Installing git hooks..."

if (Test-Path .git) {
    $hooks = @("pre-commit.ps1", "pre-push.ps1", "post-merge.ps1", "prepare-commit-msg.ps1")

    foreach ($hook in $hooks) {
        $scriptPath = "$PWD\$hook"
        $hookPath = "$PWD\.git\hooks\$hook"

        if (-Not (Test-Path $scriptPath)) {
            Write-Host "${YELLOW}Warning: The script $scriptPath does not exist. Skipping.${NC}"
            continue
        }

        if (Test-Path $hookPath) {
            Remove-Item $hookPath
        }

        # Note: Requires Developer Mode enabled or running as Administrator in Windows 10/11
        #
        # Windows 11
        # - Open Settings: Right-click on the Start button and select “Settings”, or press Windows + I.
        # - Privacy & Security: In the Settings window, select “Privacy & security” from the sidebar.
        # - For Developers: Scroll down to find the “For developers” section and click on it.
        # - Enable Developer Mode: Toggle the switch under “Developer Mode” to “On”.
        # - Accept the Warning: You will see a warning about the potential risks of enabling developer features. Read the message, and if you agree, click “Yes” to proceed.
        New-Item -ItemType SymbolicLink -Path $hookPath -Target $scriptPath

        if ($?) {
            Write-Host "${GREEN}Installed: $hook${NC}"
        } else {
            Write-Host "Failed to create symlink for $hook"
        }
    }

    Write-Host "${GREEN}All specified git hooks have been successfully installed!${NC}"
} else {
    Write-Host "${YELLOW}No .git directory found. Ensure this is run at the root of a Git repository.${NC}"
}

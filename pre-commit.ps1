$exitCode = Start-Process npm -ArgumentList "run lint:fix" -Wait -NoNewWindow -PassThru

if ($exitCode.ExitCode -ne 0) {
    Write-Host "Linting failed. Please fix the errors and try again."
    exit 1
}

Write-Host "Linting was successful."

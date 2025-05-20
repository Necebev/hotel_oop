start "PHP server" cmd /k "cd public && php -S 127.0.0.1:8000"
start "five-server" cmd /k "npx -y five-server@latest --port=5500 --open=http://localhost:8000"
taskkill /f /fi "Command Prompt"
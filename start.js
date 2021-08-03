const { spawn } = require('child_process');

function websocket() {
    const shell = spawn('php', ['artisan', 'websockets:serve']);

    shell.stdout.on('data', (data) => {
        // console.log(`Websocket: ${data}`);
        console.log(`%cWebsocket: ${data}`, "color: orange");
    });

    shell.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    shell.on('close', (code) => {
        console.log(`child process exited with code ${code}`);
    });
}
function queueWork() {
    const shell = spawn('php', ['artisan', 'queue:work']);

    shell.stdout.on('data', (data) => {
        console.log(`%cLaravel: ${data}`, "color: yellow");
    });

    shell.stderr.on('data', (data) => {
        console.error(`Laravel: ${data}`);
    });

    shell.on('close', (code) => {
        console.log(`child process exited with code ${code}`);
    });
}
function telegramBot() {
    const shell = spawn('php', ['artisan', 'starttelegrambot']);

    shell.stdout.on('data', (data) => {
        console.log(`%cNuxt: ${data}`, "color: green");
    });

    shell.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    shell.on('close', (code) => {
        console.log(`child process exited with code ${code}`);
    });
}

websocket();
queueWork();
telegramBot();

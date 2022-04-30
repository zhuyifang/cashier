var import_electron = require("electron");
debugger;
import_electron.contextBridge.exposeInMainWorld("main", {
  openMainWindow: (path) => {
    import_electron.ipcRenderer.send("startupComplete",path);
  }
});

import UIkit from 'uikit/dist/js/uikit.min.js';
import Icons from 'uikit/dist/js/uikit-icons'
import "uikit/dist/css/uikit.css";
UIkit.use(Icons)

class Utility {
  notification = (config) =>
    UIkit.notification({
      pos: "top-right",
      timeout: 5000,
      ...config,
    });
  error = (message) =>
    this.notification({
      message,
      status: "danger",
    })
}

export {Utility}

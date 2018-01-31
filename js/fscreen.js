(function() {
    var
        fullScreenApi = {
            supportsFullScreen: false,
            nonNativeSupportsFullScreen: false,
            isFullScreen: function() { return false; },
            requestFullScreen: function() {},
            cancelFullScreen: function() {},
            fullScreenEventName: '',
            prefix: ''
        },
        browserPrefixes = 'webkit moz o ms khtml'.split(' ');
 
    // check for native support
    if (typeof document.cancelFullScreen != 'undefined') {
        fullScreenApi.supportsFullScreen = true;
    } else {
        // check for fullscreen support by vendor prefix
        for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
            fullScreenApi.prefix = browserPrefixes[i];
 
            if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
                fullScreenApi.supportsFullScreen = true;
 
                break;
            }
        }
    }
 
    // update methods to do something useful
    if (fullScreenApi.supportsFullScreen) {
        fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';
 
        fullScreenApi.isFullScreen = function() {
            switch (this.prefix) {
                case '':
                    return document.fullScreen;
                case 'webkit':
                    return document.webkitIsFullScreen;
                default:
                    return document[this.prefix + 'FullScreen'];
            }
        }
        fullScreenApi.requestFullScreen = function(el) {
            return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
        }
        fullScreenApi.cancelFullScreen = function(el) {
            return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
        }
    }
    else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        fullScreenApi.nonNativeSupportsFullScreen = true;
        fullScreenApi.requestFullScreen = fullScreenApi.requestFullScreen = function (el) {
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript !== null) {
                wscript.SendKeys("{F11}");
            }
        }
        fullScreenApi.isFullScreen = function() {
            return document.body.clientHeight == screen.height && document.body.clientWidth == screen.width;
        }
    }
 
    // jQuery plugin
    if (typeof jQuery != 'undefined') {
        jQuery.fn.requestFullScreen = function() {
 
            return this.each(function() {
                if (fullScreenApi.supportsFullScreen) {
                    fullScreenApi.requestFullScreen(this);
                }
            });
        };
    }
 
    // export api
    window.fullScreenApi = fullScreenApi;
})();

function doWhenFullScreen() {
    console.log("esta en fullScreen");
}
function doWhenNotFullScreen() {
    console.log("NO esta en fullscreen");
}

if (fullScreenApi.supportsFullScreen) {
    window.addEventListener(fullScreenApi.fullScreenEventName, function(e) {
        if (fullScreenApi.isFullScreen()) {
                        doWhenFullScreen();
                }
                else {
                        doWhenNotFullScreen();
                }
        }, true);
}
else if (fullScreenApi.nonNativeSupportsFullScreen){
        //Only notify when fullscreen state changed, so save the last state
        fullScreenApi.lastState = fullScreenApi.isFullScreen();
       
        window.onresize = function() {
                //Check is duplicated
                if (fullScreenApi.lastState != fullScreenApi.isFullScreen()) {
                        fullScreenApi.lastState = fullScreenApi.isFullScreen()
                       
                        if (fullScreenApi.isFullScreen()) {
                                doWhenFullScreen();
                        }
                        else {
                                doWhenNotFullScreen();
                        }
                }
        };
}
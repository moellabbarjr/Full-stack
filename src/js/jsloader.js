function scriptLoader(path, callback) {
    let script = document.createElement("script");
    script.type = "text/javascript";
    script.async = true;
    script.src = path;
    script.onload = function() {
    if (typeof callback == "function") {
        callback();
        }
    };
    try {
        let scriptOne = document.getElementsByTagName("script")[0];
        scriptOne.parentNode.insertBefore(script, scriptOne);
    } catch (e) {
        document.getElementsByTagName("head")[0].appendChild(script);
    }
}

// js

// scriptLoader("src/js/script.js");

// api

// scriptLoader("src/api/voorbeeld.js");
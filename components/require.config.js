var components = {
    "packages": [
        {
            "name": "bootstrap",
            "main": "bootstrap-built.js"
        },
        {
            "name": "jquery",
            "main": "jquery-built.js"
        },
        {
            "name": "jquery-ui",
            "main": "jquery-ui-built.js"
        },
        {
            "name": "bootstrap-multiselect",
            "main": "bootstrap-multiselect-built.js"
        }
    ],
    "shim": {
        "bootstrap": {
            "deps": [
                "jquery"
            ]
        },
        "jquery-ui": {
            "deps": [
                "jquery"
            ],
            "exports": "jQuery"
        },
        "bootstrap-multiselect": {
            "deps": [
                "jquery"
            ]
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}
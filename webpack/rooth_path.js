const path = require('path');

// Helper functions
function rooth_path(args) {
    // return path.resolve(__dirname, args);


    args = Array.prototype.slice.call(arguments, 0);
    return path.join.apply(path, [__dirname].concat('../', ...args));
}

exports.root = rooth_path;

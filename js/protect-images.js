document.addEventListener('contextmenu', function (e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
    }
}, false);

document.addEventListener('mousedown', function (e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
    }
}, false);

document.addEventListener('dragstart', function (e) {
    if (e.target.tagName === 'IMG') {
        e.preventDefault();
    }
}, false);

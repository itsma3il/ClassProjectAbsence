// avatarGenerator.js

document.addEventListener('DOMContentLoaded', function () {
    var avatarContainers = document.querySelectorAll('.avatar-container');

    avatarContainers.forEach(function (avatarContainer) {

        var initials = avatarContainer.getAttribute('data-initials') || '';
        var width = avatarContainer.getAttribute('data-width') || '40px';

        new Avatar(avatarContainer, initials, width);
    });
});

class Avatar {
    constructor(container, initials, width = '40px') {
        this.container = container;
        this.initials = initials;
        this.width = width;
        this.createAvatar();
    }

    createAvatar() {
        var avatarElement = document.createElement('span');
        avatarElement.classList.add('avatar');
        avatarElement.style.width = this.width;
        avatarElement.style.height = this.width;

        if(this.width > '39px'){
            var fontSize = Math.max(parseInt(this.width) / 2, 12);
        }else{
            var fontSize = Math.min(parseInt(this.width) / 2, 12);
        }
        
        avatarElement.style.fontSize = fontSize + 'px';

        avatarElement.textContent = this.initials.toUpperCase();

        this.container.appendChild(avatarElement);
    }
}

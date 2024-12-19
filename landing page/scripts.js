document.addEventListener('DOMContentLoaded', () => {
    const actionItems = document.querySelectorAll('.action-item');
    const centerItems = document.querySelectorAll('.center-item');
    const getStartedButton = document.querySelector('.get-started .btn-primary');

    actionItems.forEach(item => {
        item.addEventListener('click', () => {
            alert('Action item clicked');
        });
    });

    centerItems.forEach(item => {
        item.addEventListener('click', () => {
            alert('Center of Excellence clicked');
        });
    });

    getStartedButton.addEventListener('click', () => {
        ;
    });
});

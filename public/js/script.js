document.addEventListener('DOMContentLoaded', function () {
    function toggleEditForm(id) {
        const form = document.getElementById(`edit-form-${id}`);
        if (form) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    }

    function toggleAddForm() {
        const form = document.getElementById('add-form');
        if (form) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    }


    window.toggleEditForm = toggleEditForm;
    window.toggleAddForm = toggleAddForm;

    const typeSelect = document.getElementById('type');
    const imageContainer = document.getElementById('image-container');
    const videoContainer = document.getElementById('video-container');

    if (typeSelect && imageContainer && videoContainer) {
        const toggleFields = () => {
            if (typeSelect.value === 'video') {
                imageContainer.style.display = 'none';
                videoContainer.style.display = 'block';
            } else if (typeSelect.value === 'course') {
                imageContainer.style.display = 'block';
                videoContainer.style.display = 'none';
            } else {
                imageContainer.style.display = 'none';
                videoContainer.style.display = 'none';
            }
        };

        typeSelect.addEventListener('change', toggleFields);
        toggleFields(); // bij eerste laden
    }

    const videos = document.querySelectorAll('video');
    videos.forEach(video => {
        video.addEventListener('play', () => {
            videos.forEach(otherVideo => {
                if (otherVideo !== video) {
                    otherVideo.pause();
                }
            });
        });
    });
});


    function toggleEditForm(id) {
    const form = document.getElementById(`edit-form-${id}`);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

    function toggleAddForm() {
    const form = document.getElementById('add-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

    // Get references to the type select and the price and video containers
    const typeSelect = document.getElementById('type');
    const imageContainer = document.getElementById('image-container');
    const videoContainer = document.getElementById('video-container');

    // Function to toggle the form fields based on the selected type
    typeSelect.addEventListener('change', function () {
    if (this.value === 'video') {

    imageContainer.style.display = 'none';
    videoContainer.style.display = 'block';
} else if (this.value === 'course') {

    imageContainer.style.display = 'block';
    videoContainer.style.display = 'none';
}
});

    // Initialize the form to set the correct visibility when the page loads
    if (typeSelect.value === 'video') {
    videoContainer.style.display = 'block';
} else {
    videoContainer.style.display = 'none';
}

    document.addEventListener('DOMContentLoaded', function () {
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

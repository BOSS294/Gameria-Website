document.addEventListener('DOMContentLoaded', function() {
    loadComponent('header', 'resources/nav.php');
    loadComponent('footer', 'resources/footer.php');
});

function loadComponent(elementId, url) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            document.getElementById(elementId).innerHTML = data;
        })
        .catch(error => {
            const errorCode = elementId.toUpperCase() + '-001';
            console.error(`Error fetching the component (Error Code: ${errorCode}):`, error);
            document.getElementById(elementId).innerHTML = getDefaultContent(errorCode);
        });
}

function getDefaultContent(errorCode) {
    return `
        <div class="error-message">
            <p>Error Code: ${errorCode} - Error fetching component.</p>
        </div>
    `;
}

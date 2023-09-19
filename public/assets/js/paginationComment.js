document.addEventListener('DOMContentLoaded', function() {
    const nextPageLink = document.querySelector('.next-page');
    const commentsContainer = document.querySelector('.comment-container');

    function loadPage(url) {
        fetch(url)
            .then(response => response.json()) // Parse the response as JSON
            .then(data => {
                // Loop through the tricks data and create elements
                console.log(data)
                data.comments.forEach(comment => {
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('m-auto', 'w-50', 'position-relative');
                    const commentHTML = `
                        <p>${comment.author}</p>
                        <p>${comment.content}</p>
                    `;
                    commentDiv.innerHTML = commentHTML;
                    
                    // Check if the current user is the author of the comment
                    if (data.currentUser === comment.author.username) {
                        const deleteButton = document.createElement('div');
                        deleteButton.innerHTML = `
                            <div class="position-absolute position-absolute top-0 end-0 m-2" style="background: white;">
                                <a href="/path_to_delete_endpoint?id=${comment.id}" class="p-1" onclick="return confirm('Etes-vous sûr de vouloir supprimer le commentaire ?');">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                        `;
                        commentDiv.appendChild(deleteButton);
                    }
                    commentDiv.innerHTML += '<hr>';
                    commentsContainer.appendChild(commentDiv);
                    commentsContainer.appendChild(commentDiv);
                });

                // Update the pagination links
                nextPageLink.setAttribute('data-target', `/offset=${data.next}`);
                loader.classList.remove('d-flex');
            });
    }


    nextPageLink.addEventListener('click', function(event) {
        event.preventDefault();
        const loader = document.querySelector('#loader');
        loader.classList.add('d-flex');
        const url = this.getAttribute('data-target');
        loadPage(url);
        return  false;
    });
});

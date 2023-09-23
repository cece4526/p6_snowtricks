document.addEventListener('DOMContentLoaded', function() {
    const nextPageLink = document.querySelector('.next-page');
    const tricksContainer = document.querySelector('.tricks-container');

    function loadPage(url) {
        fetch(url)
            .then(response => response.json()) // Parse the response as JSON
            .then(data => {
                // Loop through the tricks data and create elements
                data.tricks.forEach(trick => {
                    const trickDiv = document.createElement('div');
                    trickDiv.classList.add('col', 'card', 'm-2', 'card-responsive');
                    trickDiv.innerHTML = `
                        <a href="/tricks/single/${trick.slug}">
                            <img class="card-img-top home" src="/images/tricks/mini/300x300-${trick.mainImageName}" alt="">
                        </a>
                        <div class="card-body d-flex position-Srelative">
                            <a class="btn btn-outline-info btn-sm trick-link" href="/tricks/single?slug=${trick.slug}" target="_blank">${trick.name}</a>
                            <div class="position-absolute position-absolute end-0 m-2">
                                <a href="/tricks/edition/${trick.slug} " class="p-1">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <a href="/tricks/delete/${trick.slug}" class="p-1" onclick="return confirm('etes-vous sur de vouloir supprimé le trick ?');">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>                                    
                        </div>
                    `;
                    tricksContainer.appendChild(trickDiv);
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

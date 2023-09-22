const addvideoFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'supprimer la vidéo';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the video form
        item.remove();
    });
}

// adds a new item to a collection
const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    console.log(collectionHolder);
    const item = document.createElement('li');

    item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
        /__name__/g,
        collectionHolder.dataset.index
        );
    
    collectionHolder.appendChild(item);
    addvideoFormDeleteLink(item);
    collectionHolder.dataset.index++;
    };

document
    .querySelectorAll('.add_item_link')
    .forEach(btn => {
        btn.addEventListener("click", addFormToCollection)
    });

document
    .querySelectorAll('ul.videos li')
    .forEach((video) => {
        addvideoFormDeleteLink(video)
    })


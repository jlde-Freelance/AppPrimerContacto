export default function loadViewRealEstateDetail() {
    const lightbox = new PhotoSwipeLightbox({
        gallery: '#gallery-real-estate',
        children: 'a',
        showAnimationDuration: 500,
        hideAnimationDuration: 500,
        showHideAnimationType: 'zoom',
        pswpModule: PhotoSwipe
    });

    lightbox.init();
};

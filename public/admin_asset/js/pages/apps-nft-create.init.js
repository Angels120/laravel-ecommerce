FilePond.registerPlugin(
    FilePondPluginFileEncode,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview
);

var inputMultipleElements = document.querySelectorAll("input.filepond-input-multiple");

if (inputMultipleElements) {
    // Loop over multiple input elements
    Array.from(inputMultipleElements).forEach(function (inputElement) {
        // Create a FilePond instance at the input element location
        FilePond.create(inputElement,{
            acceptedFileTypes: ['image/*'],
        });
    });
}


// Create a FilePond instance for the second input with class 'filepond'
FilePond.create(document.querySelector(".filepond-single"), {
    acceptedFileTypes: ['image/*'],
    labelIdle: 'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    stylePanelLayout: 'compact', // Change to 'compact' for square layout
    styleLoadIndicatorPosition: 'center bottom',
    styleProgressIndicatorPosition: 'right bottom',
    styleButtonRemoveItemPosition: 'left bottom',
    styleButtonProcessItemPosition: 'right bottom',
});
// Create a FilePond instance for the first input with class 'filepond-input-circle'
FilePond.create(document.querySelector(".filepond-input"), {
    labelIdle:
        'Drag & Drop your picture or <span class="filepond--label-action">Browse</span>',
    imagePreviewHeight: 170,
    imageCropAspectRatio: "1:1",
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    stylePanelLayout: "compact circle",
    styleLoadIndicatorPosition: "center bottom",
    styleProgressIndicatorPosition: "right bottom",
    styleButtonRemoveItemPosition: "left bottom",
    styleButtonProcessItemPosition: "right bottom",
});


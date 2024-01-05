$(document).ready(function(){
    FilePond.registerPlugin(FilePondPluginFileEncode,FilePondPluginFileValidateSize,FilePondPluginImageExifOrientation,FilePondPluginImagePreview)
    var filepondInputs = document.querySelectorAll(".filepond")
    filepondInputs.forEach((filepondInput) => {
        FilePond.create(filepondInput)
    })


  


    $(".nav-link.active").removeClass("collapsed")
    $(".nav-link.active").attr("aria-expanded", "true")

    $(".nav-link.active").next().removeClass("collapse")

})


// console.log("datepicker")



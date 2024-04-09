/**
 * Checks if a file is an image.
 * @param {File} file - The file to check.
 * @returns {boolean} - Whether the file is an image.
 */
export function isImage(file) {
    return /^image\/\w+$/.test(file.mime);
}

export function isPdf(file) {
    return [
        'application/pdf',
        'application/x-pdf',
        'application/acrobat',
        'application/vnd.pdf',
        'text/pdf',
        'text/x-pdf',
    ].includes(file.mime)
}

export function isWord(file) {
    return [
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-word.document.macroEnabled.12',
        'application/vnd.ms-word.template.macroEnabled.12',
    ].includes(file.mime)
}

export function isExcel(file) {
    return [
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-excel.sheet.macroEnabled.12',
        'application/vnd.ms-excel.template.macroEnabled.12',
    ].includes(file.mime)
}

export function isPpt(file) {
    return [
        'application/vnd.ms-powerpoint',
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
        'application/vnd.ms-powerpoint.template.macroEnabled.12'
    ].includes(file.mime)
}

export function isZip(file) {
    return [
        'application/zip',
        'application/x-zip',
        'application/x-zip-compressed',
    ].includes(file.mime)
}

export function isAudio(file) {
    return [
        'audio/mpeg',
        'audio/ogg',
        'audio/mp3',
        'audio/wav',
        'audio/x-wav',
        'audio/webm',
        'audio/x-m4a'
    ].includes(file.mime)
}

export function isVideo(file) {
    return [
        'video/mpeg',
        'video/mp4',
        'video/ogg',
        'video/quicktime',
        'video/webm',
        'video/x-m4v'
    ].includes(file.mime)
}

export function isText(file) {
    return [
        'text/plain',
        'text/html',
        'text/css',
        'text/javascript',
        'text/xml',
        'text/csv',
    ].includes(file.mime)
}

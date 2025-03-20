const video = document.getElementById('inputVideo');
const canvas = document.getElementById('overlay');

(async () => {
    const stream = await navigator.mediaDevices.getUserMedia({ video: {} });
    video.srcObject = stream;
})();

async function onPlay() {
    const MODEL_URL = '/models'; // Corrected model path

    // Load all the models
    await faceapi.loadSsdMobilenetv1Model(MODEL_URL);
    await faceapi.loadAgeGenderModel(MODEL_URL);
    await faceapi.loadFaceLandmarkModel(MODEL_URL);
    await faceapi.loadFaceRecognitionModel(MODEL_URL);
    await faceapi.loadFaceExpressionModel(MODEL_URL);
    await faceapi.loadTinyFaceDetectorModel(MODEL_URL);

    // Detect faces
    let fullFaceDescriptions = await faceapi.detectAllFaces(video)
        .withFaceLandmarks()
        .withFaceDescriptors()
        .withFaceExpressions()
        .withAgeAndGender();  // Assuming you're using face-api.js that supports age and gender

    // Match dimensions for resizing
    const dims = faceapi.matchDimensions(canvas, video, true);
    const resizedResults = faceapi.resizeResults(fullFaceDescriptions, dims);

    // Draw the results on the canvas
    faceapi.draw.drawDetections(canvas, resizedResults);
    faceapi.draw.drawFaceLandmarks(canvas, resizedResults);
    faceapi.draw.drawFaceExpressions(canvas, resizedResults, 0.05);

    // Now add age and gender labels for each detected face
    resizedResults.forEach(result => {
        const { age, gender } = result;  // Extract age and gender information
        const box = result.detection.box;

        // Draw the box with age and gender label
        new faceapi.draw.DrawBox(box, {
            label: `${Math.round(age)} años, ${gender}`  // Example: 30 años, male
        }).draw(canvas);
    });

    // Use requestAnimationFrame for smoother and more efficient rendering
    requestAnimationFrame(onPlay);  // Call onPlay again in the next available frame
}




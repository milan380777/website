
  function translateReview(review, targetLanguage) {
    // Replace 'YOUR_GOOGLE_API_KEY' with your actual Google Cloud API key
    const apiKey = 'YOUR_GOOGLE_API_KEY';
    const apiUrl = `https://translation.googleapis.com/language/translate/v2?key=${apiKey}`;

    // Replace 'en' with the target language code for English
    const sourceLanguage = 'ja';

    const textToTranslate = review.innerText;

    fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        q: textToTranslate,
        source: sourceLanguage,
        target: targetLanguage,
        format: 'text',
      }),
    })
      .then(response => response.json())
      .then(data => {
        const translatedText = data.data.translations[0].translatedText;
        alert(`Translated to ${targetLanguage}:\n\n${translatedText}`);
      })
      .catch(error => {
        console.error('Translation error:', error);
      });
  }

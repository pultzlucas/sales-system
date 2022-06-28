import { initializeApp } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-app.js";
import { getDatabase } from "https://www.gstatic.com/firebasejs/9.8.4/firebase-database.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyD321D2bwStA_ceuFvUXAynXTa5l2KIsis",
    authDomain: "juneterealtimedb.firebaseapp.com",
    databaseURL: "https://juneterealtimedb-default-rtdb.firebaseio.com",
    projectId: "juneterealtimedb",
    storageBucket: "juneterealtimedb.appspot.com",
    messagingSenderId: "787964355463",
    appId: "1:787964355463:web:54154b7b534f6f87a36922"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getDatabase()

export default db
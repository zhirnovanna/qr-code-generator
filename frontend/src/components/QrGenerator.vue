<template>
  <div class="qr-generator-wrapper">
    <div class="qr-generator">
      <h1>Générateur de QR Code</h1>

      <!-- Formulaire -->
      <div class="form-group">
        <input
          v-model="text"
          type="text"
          placeholder="Entrez le texte ou l'URL"
        />
        <button @click="generateQr">Générer</button>
      </div>

      <!-- QR généré en direct -->
      <transition name="pop">
        <div v-if="qrData" class="qr-result">
          <h3>QR généré</h3>
          <img :src="qrData" alt="QR Code" />
          <p class="qr-text">{{ text }}</p>
          <a :href="qrData" download="qr-code.png" class="download-btn">
            Télécharger le QR Code
          </a>
        </div>
      </transition>

      <!-- Historique -->
      <div class="history" v-if="history.length">
        <h3>Historique</h3>
        <ul class="history-list">
          <li v-for="item in history" :key="item.id" class="history-item">
            <p>
              <strong>
                <a
                  :href="item.text"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="history-link"
                >
                  {{ item.text }}
                </a>
              </strong>
              <small> ({{ new Date(item.created_at).toLocaleString() }})</small>
            </p>
            <img :src="item.image_base64" alt="QR" class="qr-preview" />
            <button @click="reuse(item.text)">Réutiliser</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import "./QrGenerator.css";
import axios from "axios";

export default {
  name: "QrGenerator",
  data() {
    return {
      text: "",
      qrData: null,
      history: [],
    };
  },
  methods: {
    async generateQr() {
      if (!this.text.trim()) {
        alert("Veuillez entrer du texte !");
        return;
      }
      try {
        const res = await axios.post("http://127.0.0.1:8000/api/qrcodes", {
          text: this.text,
        });

        this.qrData = res.data.image_base64;
        await this.fetchHistory();
      } catch (error) {
        console.error(error);
        alert("Erreur lors de la génération du QR Code.");
      }
    },
    async fetchHistory() {
      try {
        const res = await axios.get("http://127.0.0.1:8000/api/qrcodes");
        this.history = res.data;
      } catch (error) {
        console.error("Erreur lors du chargement de l’historique", error);
      }
    },
    reuse(text) {
      this.text = text;
      this.generateQr();
    },
  },
  mounted() {
    this.fetchHistory();
  },
};
</script>

<script setup>
import { ref } from "vue";
import axios from "axios";

const imageFile = ref(null);
const imageUrl = ref(null);
const isLoading = ref(false);

const handleFileUpload = async (event) => {
  const file = event.target.files[0];
  if (!file) return;

  imageFile.value = file;
  isLoading.value = true;

  const formData = new FormData();
  formData.append("image", file);

  try {
    const response = await axios.post("http://localhost:8000/api/upload", formData, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });

    console.log(response);

    imageUrl.value = response.data.url;
  } catch (error) {
    console.error("Erreur lors de l'upload :", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <div class="upload-container">
    <input type="file" @change="handleFileUpload" />
    <p v-if="isLoading">Upload en cours...</p>
    <div v-if="imageUrl">
      <p>Image uploadée :</p>
      <img :src="imageUrl" alt="Uploaded Image" />
    </div>
  </div>
</template>

<style scoped>
.upload-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}

img {
  width: 200px;
  border-radius: 10px;
  margin-top: 10px;
  border: 2px solid #ddd;
}
</style>

<script setup>
const props = defineProps(["errors"]);
</script>

<template>
    <div class="row mb-3" v-if="errors">
        <div class="alert alert-warning" role="alert" v-for="(value, key) in errors" :key="key">
            <span v-for="error in value" :key="error">{{ error }}</span>
        </div>
    </div>
</template>

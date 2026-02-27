<template>
    <div class="form-container">
        <el-form :inline="true" :model="form" class="demo-form-inline">
            <el-form-item label="Name">
                <el-input v-model="form.name" placeholder="Name" clearable :class="{ 'my-input': true, long: true }" />
            </el-form-item>
            <el-form-item label="Price">
                <el-input v-model="form.priceFrom" placeholder="From" clearable :class="{ 'my-input': true }" />
                <el-input v-model="form.priceTo" placeholder="To" clearable :class="{ 'my-input': true }" />
            </el-form-item>
            <el-form-item label="Bedrooms">
                <el-input-number v-model="form.bedrooms" :min="0" :max="10" :class="{ 'my-input': true }" />
            </el-form-item>
            <el-form-item label="Bathrooms">
                <el-input-number v-model="form.bathrooms" :min="0" :max="10" :class="{ 'my-input': true }" />
            </el-form-item>
            <el-form-item label="Storeys">
                <el-input-number v-model="form.storeys" :min="0" :max="10" :class="{ 'my-input': true }" />
            </el-form-item>
            <el-form-item label="Garages">
                <el-input-number v-model="form.garages" :min="0" :max="10" :class="{ 'my-input': true }" />
            </el-form-item>
        </el-form>
    </div>

    <el-table :data="tableData" style="width: 50%" v-loading="isLoading">
        <el-table-column prop="name" label="Name" />
        <el-table-column prop="price" label="Price" />
        <el-table-column prop="bedrooms" label="Bedrooms" />
        <el-table-column prop="bathrooms" label="Bathrooms" />
        <el-table-column prop="storeys" label="Storeys" />
        <el-table-column prop="garages" label="Garages" />
    </el-table>
</template>

<script lang="ts" setup>
import axios from 'axios'
import { ElMessage } from 'element-plus'
import { ref, reactive, watch } from 'vue'

const tableData = ref(null)
const isLoading = ref(false)

const form = reactive({
    name: '',
    priceFrom: '',
    priceTo: '',
    bedrooms: '',
    bathrooms: '',
    storeys: '',
    garages: '',
})

const fetchData = async (formData) => {
    isLoading.value = true
    try {
        tableData.value = null
        const response = await axios.post('/api/apartments-search', formData)
        tableData.value = response.data
        ElMessage({
            message: 'Данные успешно загружены',
            type: 'success',
            placement: 'bottom-right',
        })
    } catch (error) {
        ElMessage.error('Ошибка при запросе')
        console.error(error)
    } finally {
        isLoading.value = false
    }
}

const handleFormChange = (formData) => {
    fetchData(formData)
}

watch(
    form,
    (formData) => {
        handleFormChange(formData);
    },
    { deep: true }
);
</script>

<style>
.form-container {
    padding: 20px;
}

.my-input {
    max-width: 100px;

    &.long {
        max-width: 200px;
    }
}
</style>

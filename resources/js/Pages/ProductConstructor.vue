<template>
    <div class="product-constructor">
        <div class="canvas-container">
            <canvas ref="canvas" id="productCanvas"></canvas>
        </div>

        <div class="controls">
            <label for="productSelect">Выберите продукт:</label>
            <select id="productSelect" v-model="selectedProductId" @change="onProductChange">
                <option v-for="product in products" :key="product.id" :value="product.id">
                    {{ product.name }}
                </option>
            </select>

            <div v-if="selectedProduct && selectedProduct.productColors && selectedProduct.productColors.length">
                <label for="colorSelect">Выберите цвет:</label>
                <select id="colorSelect" v-model="selectedColorImage" @change="onColorChange">
                    <option v-for="color in selectedProduct.productColors" :key="color.id" :value="color.image_url">
                        {{ color.color }}
                    </option>
                </select>
            </div>

            <div class="upload-controls">
                <input type="file" name="file" @change="onImageUpload" />
                <button @click="resetImage">Сбросить</button>
            </div>
        </div>
    </div>
</template>

<script>
import { fabric } from 'fabric';

export default {
    props: {
        products: Array,
    },
    data() {
        return {
            selectedProductId: null,
            selectedProduct: null,
            selectedColorImage: null,
            uploadedImage: null,
            canvas: null,
        };
    },
    methods: {
        onProductChange() {
            console.log('Текущие данные продуктов:', this.products); // Логирование всех продуктов
            console.log('Выбранный ID продукта:', this.selectedProductId); // Логирование ID выбранного продукта

            this.selectedProduct = this.products.find((product) => product.id === this.selectedProductId);

            if (!this.selectedProduct) {
                console.error("Продукт не найден!");
            }

            if (this.selectedProduct && this.selectedProduct.productColors && this.selectedProduct.productColors.length > 0) {
                this.selectedColorImage = this.selectedProduct.productColors[0].image_url;
                this.updateCanvas();
            } else {
                console.error("Цвета для выбранного продукта не найдены!");
            }
        },

        onColorChange() {
            if (this.selectedProduct) {
                this.updateCanvas();
            }
        },

        onImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.uploadedImage = e.target.result;
                    this.addImageToCanvas(this.uploadedImage);
                };
                reader.readAsDataURL(file);
            }
        },

        resetImage() {
            this.uploadedImage = null;
            this.canvas.clear();
            this.updateCanvas();
        },

        initCanvas() {
            this.canvas = new fabric.Canvas(this.$refs.canvas);
            this.canvas.setWidth(600);
            this.canvas.setHeight(600);
        },

        updateCanvas() {
            if (this.canvas && this.selectedColorImage) {
                console.log("Загрузка изображения товара:", this.selectedColorImage);
                this.canvas.clear();
                const productImage = new fabric.Image.fromURL(this.selectedColorImage, (img) => {
                    img.scaleToWidth(400);
                    this.canvas.add(img);
                    this.canvas.renderAll();
                });
            } else {
                console.error("Ошибка: Невозможно загрузить изображение для товара");
            }
        },

        addImageToCanvas(imageURL) {
            if (this.canvas) {
                const image = new fabric.Image.fromURL(imageURL, (img) => {
                    img.scaleToWidth(100);
                    img.set({
                        left: 150,
                        top: 150,
                    });
                    this.canvas.add(img);
                    this.canvas.renderAll();
                });
            }
        },
    },

    created() {
        this.initCanvas();

        if (this.products.length > 0) {
            this.selectedProductId = this.products[0].id;
            this.onProductChange();
        }
    },
};
</script>

<style scoped>
.canvas-container {
    position: relative;
    margin-top: 30px;
    text-align: center;
}

#productCanvas {
    border: 1px solid #ccc;
    max-width: 600px;
    max-height: 600px;
    margin: 0 auto;
}

.upload-controls {
    margin-top: 20px;
}

.controls {
    text-align: center;
}

.upload-controls input {
    margin-top: 10px;
}
</style>

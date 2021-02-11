<template>
    <div class="content">
        <form name="find" @submit.prevent="sendRequest">
            <input
                v-model="number"
                type="number"
                name="number"
                class="number"
                placeholder="Введите число"
                required
            />
            <button :disabled="disabled">RUN</button>
        </form>
        <div class="headline">Ближийшее число Фибоначчи:</div>
        <div id="fibonacci" class="fibonacci">{{ message }}</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                number: '',
                message: '',
                disabled: true,
            };
        },
        methods: {
            sendRequest() {
                let number = this.number;
                this.disabled = true;
                this.axios
                    .post('/find', {
                        number: number,
                    })
                    .then((response) => {
                        this.message = response.data.message;
                        this.disabled = false;
                    })
                    .catch((err) => {
                        this.message = err.response.data.message;
                        this.disabled = false;
                    });
            },
        },
        watch: {
            number: function(val) {
                this.disabled = !val.match(/[0-9]/);
            },
        },
    };
</script>

<style>
    input {
        padding: 10px;
        margin: 10px 0;
        border: 2px solid #eee;
        box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        border-radius: 10px;
        width: 300px;
    }
    input:focus,
    input:active {
        border-color: #29b6f6;
        outline: none;
    }
    button {
        padding: 10px;
        border: 2px solid #eee;
        box-shadow: 0 0 15px 4px rgba(0, 0, 0, 0.06);
        border-radius: 10px;
        background-color: #29b6f6;
        color: #ffffff;
        outline: none;
    }
    button:hover,
    button:active {
        cursor: pointer;
        background-color: #0086c3;
        outline: none;
    }
    button:disabled {
        background-color: #cfcfcf;
        color: #616161;
        cursor: default;
    }
    .content {
        display: flex;
        flex-direction: column;
        margin-top: 200px;
        text-align: center;
    }
    .headline {
        margin-top: 20px;
        font-size: 24px;
        color: #616161;
    }
    .fibonacci {
        margin-top: 10px;
        text-align: center;
        font-size: 20px;
        color: #373737;
    }
</style>

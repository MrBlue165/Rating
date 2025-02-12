<script setup lang="ts">
import { ref } from 'vue';
const props = defineProps<{


}>();
const display_name = ref('');
const login_name = ref('');
const email = ref('');
const password = ref('');
const confirm_password = ref('');
const error_message = ref('');

const handleSubmit = async() => {
    if(password.value !== confirm_password.value)
    {
        error_message.value = "Passwords Don't Match";
        return;
    }

    try{
        const response = await fetch('/register', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
            },
            body: JSON.stringify({
                display_name: display_name.value,
                login_name: login_name.value,
                email: email.value,
                password: password.value,
            }),
        });
        if (!response.ok) {
            const result = await response.json();
            error_message.value = result.message || 'Registration failed';
            return;
        }
        error_message.value = '';
        alert('Registration successful');

    }
    catch (error)
    {
        error_message.value = 'There has been some problem with your registration, please try again later!';
    }

}


</script>

<template>
    <div class="background-wrapper">
        <div class="reg-container">
            <h1>Register</h1>
            <form @submit.prevent="handleSubmit">
                <div class="reg-wrapper">
                    <label for="display_name">Display name</label>
                    <div class="input-wrapper">
                        <input type="text" id="display_name" v-model="display_name" required>
                    </div>
                </div>
                <div class="reg-wrapper">
                    <label for="login_name">Login name</label>
                    <div class="input-wrapper">
                    <input type="text" id="login_name" v-model="login_name" required>
                    </div>
                </div>
                <div class="reg-wrapper">
                    <label for="email">E-Mail</label>
                    <div class="input-wrapper">
                    <input type="email" id="email" v-model="email" required>
                    </div>
                </div>
                <div class="reg-wrapper">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="password" v-model="password" required>
                    </div>
                </div>
                <div class="reg-wrapper">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="confirmPassword" v-model="confirm_password" required>
                    </div>
                </div>
                <div v-if="error_message" class="error-message">{{error_message}}</div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</template>


<style scoped lang="sass">
.background-wrapper
    @apply bg-[#727272] min-h-screen
    @apply flex flex-row

.reg-container
    @apply flex flex-col items-center justify-start
    @apply p-[20px] max-w-lg m-auto min-w-96
    @apply bg-[#444] text-white rounded-md
    h1
        @apply font-bold text-2xl
.reg-wrapper
    @apply flex items-start justify-start w-full flex-col
.input-wrapper
    @apply w-full
form
    @apply flex flex-col gap-[10px] w-full
input
    @apply p-[8px] text-[14px] border w-full
    @apply border-solid border-[#ccc] rounded-[4px]
button
    @apply p-2 py-3 text-[16px] bg-[#656565] text-white
    @apply border-none rounded-[4px] cursor-pointer mt-3
button:hover
    @apply bg-[#878787]
.error-message
    @apply text-red-500 text-[12px] mt-[10px]
</style>

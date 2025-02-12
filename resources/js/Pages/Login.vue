<script setup lang="ts">
import { ref } from 'vue';
const props = defineProps<{


}>();


const login_name = ref('');
const password = ref('');
const confirm_password = ref('');
const error_message = ref('');


const handleSubmit = async() => {
    if(password.value !== confirm_password.value)
    {
        error_message.value = "Incorrect password";
        if(login_name.value !== login_name.value) error_message.value = "Invalid login name";
        return;
    }

    try{
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
            },
            body: JSON.stringify({
                username: login_name.value,
                password: password.value,
            }),
        });
        if(!response.ok)
        {
            const result = await response.json();
            error_message.value = result.message||'Login failed';
        }


    }
    catch (error)
    {
        error_message.value = 'We had some problems logging you in, please try again later!';
    }

}


</script>

<template>
    <div class="background-wrapper">
        <div class="log-container">
            <h1>Login</h1>
            <form @submit.prevent="handleSubmit">
                <div class="log-wrapper">
                    <label for="login_name">Username or Email</label>
                    <div class="input-wrapper">
                    <input type="text" id="login_name" v-model="login_name" required>
                    </div>
                </div>
                <div class="log-wrapper">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                    <input type="password" id="password" v-model="password" required>
                    </div>
                </div>
                <div v-if="error_message" class="error-message">{{error_message}}</div>
                <button type="submit">Login</button>

            </form>
        </div>
    </div>
</template>


<style scoped lang="sass">
.background-wrapper
    @apply bg-[#727272] min-h-screen
    @apply flex flex-row

.log-container
    @apply flex flex-col items-center justify-start
    @apply p-[20px] max-w-lg m-auto min-w-96
    @apply bg-[#444] text-white rounded-md
    h1
        @apply font-bold text-2xl
.log-wrapper
    @apply flex items-start justify-start w-full flex-col
.input-wrapper
    @apply w-full
form
    @apply flex flex-col gap-[10px] w-full
input
    @apply p-[8px] text-[14px] border w-full
    @apply border-solid border-[#333] rounded-[4px]
    @apply bg-[#565656]
input:focus
    @apply ring-red-700 ring-offset-red-700 outline-none border-red-700 focus:border-red-700
button
    @apply p-2 py-3 text-[16px] bg-[#656565] text-white
    @apply border-none rounded-[4px] cursor-pointer mt-3
button:hover
    @apply bg-[#878787] ring-red-700 ring-offset-red-700 outline-none border-red-700 focus:border-red-700
    @apply hover:ring-1  focus:ring-offset-1 hover:ring-offset-2  p-3 border-0 rounded-md outline-none
.error-message
    @apply text-red-500 text-[12px] mt-[10px]
</style>

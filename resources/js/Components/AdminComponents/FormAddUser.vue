<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import {ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {UserPlusIcon} from "@heroicons/vue/24/outline";
import {defineEmits} from 'vue';

const emit = defineEmits(['closeModal']);

const closeForm = () => {
    emit('closeModal');
};
const roles = [
    {name: 'Бэк-офис', value: 'back_office'},
    {name: 'Оператор', value: 'operator'},
];

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
});

const selectedRoleName = ref('');
const selectedRoleValue = ref('');

const selectRole = (role) => {
    selectedRoleName.value = role.name;
    selectedRoleValue.value = role.value;
    form.role = role.value; // Обновляет form.role для отправки данных формы
};

const submitForm = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            closeForm();
        },
    });
};
</script>

<template>
    <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Добавить нового пользователя
            </h2>
            <UserPlusIcon class="mx-auto h-12 w-12 text-gray-600"/>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <form class="space-y-6" @submit.prevent="submitForm">
                    <div>
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Имя</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" autocomplete="name" required=""
                                   v-model="form.name"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                        <div v-if="form.errors.name" class="text-red-500">
                            {{form.errors.name}}
                        </div>
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email-адрес</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required=""
                                   v-model="form.email"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                        <div v-if="form.errors.email" class="text-red-500">
                            {{ form.errors.email }}
                        </div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Пароль</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                   required=""
                                   v-model="form.password"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                        <div v-if="form.errors.password" class="text-red-500">
                            {{ form.errors.password}}
                        </div>
                        </div>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                            Повторите
                            пароль
                        </label>
                        <div class="mt-2">
                            <input id="password" name="password_confirmation" type="password"
                                   autocomplete="current-password"
                                   required=""
                                   v-model="form.password_confirmation"
                                   class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                        <div v-if="form.errors.password_confirmation">
                            {{ form.errors.password_confirmation}}
                        </div>
                        </div>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Роль</label>
                        <div class="mt-2">
                            <Dropdown>
                                <template #trigger>
                                    <button type="button"
                                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                    >
                                        <span>{{ selectedRoleName || 'Выберите роль' }}</span>

                                    </button>
                                </template>
                                <template #content>
                                    <div class="flex flex-col w-full">
                                        <span v-for="role in roles" :key="role" @click="selectRole(role)"
                                              class="w-full hover:bg-gray-200 text-center">
                                            {{ role.name }}
                                        </span>
                                    </div>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

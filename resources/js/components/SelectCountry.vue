<template>
    <select
        class="selectpicker form-control f16"
        :title="this.title"
        :value="this.value"
        data-live-search="true"
    >
        <option
            v-for="(country, code) in allCountries"
            :data-icon="'inline-flag flag ' + code.toLowerCase()"
            :value="code"
            v-text="country"
        ></option>
    </select>
</template>

<script>
    import countries from 'i18n-iso-countries';
    import langs_en from "i18n-iso-countries/langs/en.json";
    import langs_ru from "i18n-iso-countries/langs/ru.json";

    export default {
        props: ['locale', 'title', 'value'],

        components: {countries, langs_en, langs_ru},

        data() {
            return {
                allCountries: {},
            }
        },

        created() {
            countries.registerLocale(langs_en);
            countries.registerLocale(langs_ru);
            this.allCountries = countries.getNames(this.locale);
        },
    }
</script>

<style scoped>

</style>

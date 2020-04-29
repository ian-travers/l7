<template>
    <select
        class="selectpicker form-control f16"
        :title="this.title"
        data-live-search="true"
        onchange="console.log(this.value)"
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
        props: ['locale', 'title'],

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

        methods: {
            ssd() {
                alert('12300');
            }
        }
    }
</script>

<style scoped>

</style>

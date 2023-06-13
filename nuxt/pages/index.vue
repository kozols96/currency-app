<script setup lang="ts">
import { SelectedCurrencyRateData, CurrencyRateResponse } from '~/types'

const { data }: { data: Ref<CurrencyRateResponse> } = await useFetch('http://localhost/api/v1/currency')
const currencyRates = data.value?.data

const currencies = ref(['USD', 'GBP', 'AUD'])
const selectedCurrency = ref('USD')
const eurTo = computed(() => 'EUR to ' + selectedCurrency.value)

const selectedCurrencyRateData = computed(() => {
	return <SelectedCurrencyRateData[]>currencyRates?.map(currencyRate => {
		return {
			date: currencyRate.lastUpdate,
			currency: <number>currencyRate[selectedCurrency.value]
		}
	})
})
</script>

<template>
	<section v-if="data">
		<h1 class="text-center my-5">{{ eurTo }} Exchange Rate</h1>
		<select class="form-select mb-5" v-model="selectedCurrency">
			<option v-for="currency in currencies" :key="currency">
				{{ currency }}
			</option>
		</select>
		<CurrencyRateTable :eur-to="eurTo" :selected-currency-data="selectedCurrencyRateData" />
	</section>
	<section v-else>
		<h1 class="text-center my-5">Sorry, but currently the page is not working!</h1>
	</section>
</template>

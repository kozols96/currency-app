<script setup lang="ts">
import { SelectedCurrencyRateData } from '~/types'

const props = defineProps<{
	selectedCurrencyData: SelectedCurrencyRateData[],
	eurTo: string,
	selectedCurrency: string
}>()

const currencies = computed(() => props.selectedCurrencyData?.map(selectedCurrency => selectedCurrency.currency))
const minCurrency = computed(() => Math.min(...currencies.value))
const maxCurrency = computed(() => Math.max(...currencies.value))
const averageCurrency = computed(() =>
	(currencies.value.reduce((previousValue, currentValue) => previousValue + currentValue) / currencies.value.length)
		.toFixed(4)
)
</script>

<template>
	<div>
		<table class="table mb-5">
			<thead>
			<tr>
				<th>Date</th>
				<th>{{ eurTo }}</th>
			</tr>
			</thead>
			<tbody class="overflow-y-auto h-25">
			<tr v-for="currencyRate in selectedCurrencyData">
				<td>{{ currencyRate.date }}</td>
				<td>{{ currencyRate.currency }}</td>
			</tr>
			</tbody>
		</table>
		<p class="text-center">
			Minimum: {{ `${minCurrency} ${selectedCurrency}` }}, Maximum: {{ `${maxCurrency} ${selectedCurrency}` }}
		</p>
		<p class="text-center">
			Average: {{ `${averageCurrency} ${selectedCurrency}` }}
		</p>
	</div>
</template>

<style lang="scss" scoped>

</style>

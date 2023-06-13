<script setup lang="ts">
import { SelectedCurrencyRateData } from '~/types'

defineProps({
	selectedCurrencyData: Array as PropType<SelectedCurrencyRateData[]>,
	eurTo: String
})
</script>

<template>
	<table class="table">
		<thead>
		<tr>
			<th>Date</th>
			<th>{{ eurTo }}</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="currencyRate in selectedCurrencyData">
			<td>{{ currencyRate.date }}</td>
			<td>{{ currencyRate.currency }}</td>
		</tr>
		</tbody>
	</table>
</template>

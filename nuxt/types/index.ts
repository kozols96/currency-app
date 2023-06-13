type CurrencyRate = {
    lastUpdate: string,
    [key: string]: number | string
}

type SelectedCurrencyRateData = {
    date: string,
    currency: number
}

interface CurrencyRateResponse {
    data: CurrencyRate[]
}

export { CurrencyRate, SelectedCurrencyRateData, CurrencyRateResponse }

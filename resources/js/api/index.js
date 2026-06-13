import axios from 'axios'

const api = axios.create({
    baseURL: '/api/frontend',
    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
    withCredentials: true,
})

// Attach CSRF token to every mutating request
api.interceptors.request.use(config => {
    const token = document.head.querySelector('meta[name="csrf-token"]')
    if (token) config.headers['X-CSRF-TOKEN'] = token.content
    return config
})

export const getSettings    = ()          => api.get('/settings')
export const trackShipment  = (number)    => api.post('/track', { trackingnumber: number })
export const getPaymentMethods = ()       => api.get('/payment-methods')
export const createDeposit  = (data)      => api.post('/deposits', data)
export const submitPaymentProof = (form)  => api.post('/payment-proof', form, {
    headers: { 'Content-Type': 'multipart/form-data' },
})
export const getInvoice     = (id)        => api.get(`/invoice/${id}`)
export const getReceipt     = (id)        => api.get(`/receipt/${id}`)

export default api

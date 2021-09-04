
class RestService {
    resource = '/api'
    //* **************************************************** *//
    async getAll (queryParam = {}) {
      return await axios.get(`${this.resource}/customers${queryParam}`)
    }

    async getCountries () {
      return await axios.get(`${this.resource}/countries`)
    }

    //* **************************************************** *//
  }
  export default new RestService

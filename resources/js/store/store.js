import { createStore } from 'vuex'

export default createStore({
  state: {
    rows: [],
    errors: [],
    useMiddleware: true,
  },
  getters: {
    rows: state => state.rows,
    errors: state => state.errors,
    postData(state) {
      let data = {}
      let filtered = _.reject(state.rows, {disabled: true})

      _.each(filtered, row => {
        data['rule-' + row.id] = row.rule

        if (row.send_value) {
          let valueToSend = String(row.value)

          if (! /^\-?[0-9]+$/.test(row.value)) {
            try {
              valueToSend = JSON.parse(row.value)
            } catch (_) {}
          }

          data['value-' + row.id] = valueToSend
        }
      })

      return data
    },
  },
  mutations: {
    addRow(state, row) {
      if (!row) {
        row = {
          rule: 'required|string',
          value: '',
        }
      }

      row = _.defaults(row, { disabled: false }, { send_value: true });

      let maxId = _.max(_.map(state.rows, 'id')) || 0
      row.id = maxId + 1

      state.rows.push(row)
    },
    deleteRow(state, rowId) {
      state.rows = _.reject(state.rows, {id: rowId})
    },
    deleteAllRows(state) {
      state.rows = []
    },
    updateRow(state, updatedRow) {
      state.rows = state.rows.map(item => {
        if (item.id === updatedRow.id) {
          return updatedRow
        }
        return item
      })
    },
    toggleRowDisabled(state, toggledRow) {
      state.rows = state.rows.map(item => {
        if (item.id === toggledRow.id) {
          toggledRow.disabled = !toggledRow.disabled
          return toggledRow
        }
        return item
      })
    },
    toggleRowSendValue(state, toggledRow) {
      state.rows = state.rows.map(item => {
        if (item.id === toggledRow.id) {
          toggledRow.send_value = !toggledRow.send_value
          return toggledRow
        }
        return item
      })
    },
    nullRow(state, row) {
      state.rows = state.rows.map(item => {
        if (item.id === row.id) {
          row.value = null
          return row
        }
        return item
      })
    },
    toggleMiddleware(state, bool) {
      state.useMiddleware = bool
    },
    setErrors(state, errors) {
      state.errors = errors
    },
  },
  actions: {
    validate({state, getters, commit}) {
      let url = '/api/validate'

      if (! state.useMiddleware) {
        url += '?disable-middleware'
      }

      axios.post(url, getters.postData)
          .then(() => commit('setErrors', []))
          .catch(error => commit('setErrors', error.response.data.errors))
      }
    },
})

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    hashid: null,
    maxRows: 6,
    rows: [],
    errors: [],
    saving: false,
    saveFailed: false,
    savedRows: null,
    useMiddleware: true,
  },
  getters: {
    rows: state => state.rows,
    errors: state => state.errors,
    count: state => state.rows.length,
    rowLimitReached: state => state.rows.length >= state.maxRows,
    saveFailed: state => state.saveFailed,
    savedDiff: state => state.rows == state.savedRows,
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
    base64Url(state) {
      let url = window.location.protocol + '//' +  window.location.host

      if (state.rows.length) {
        const json = JSON.stringify(state.rows)
        return url + '/' + btoa(json)
      }

      return url
    },
    hashUrl(state) {
      if (state.hashid) {
        return window.location.protocol + '//' +  window.location.host + '/' + state.hashid
      }
      return null
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
    setSaving(state, bool) {
      state.saving = bool
    },
    setHashid(state, str) {
      state.hashid = str
    },
    setSavedRows(state) {
      state.savedRows = state.rows
    },
    setSaveFailed(state, bool) {
      state.saveFailed = bool
    },
  },
  actions: {
    validate({state, getters, commit}) {
      if (!state.saving) {
        commit('setSaving', true)

        let url = '/api/validate'
        if (! state.useMiddleware) {
          url += '?disable-middleware'
        }

        axios.post(url, getters.postData)
           .then(() => commit('setErrors', []))
           .catch(error => commit('setErrors', error.response.data.errors))
           .finally(() => commit('setSaving', false))
      }
    },
    save({state, getters, commit}) {
      if (state.saving || getters.savedDiff || !getters.count) {
        return
      }

      commit('setSaving', true)

      let data = {
        json: JSON.stringify(getters.rows)
      }

      axios.post('/api/save', data)
        .then(response => {
          commit('setHashid', response.data)
          commit('setSaveFailed', false)
        })
        .catch(error => {
          commit('setSaveFailed', true)
        })
        .finally(() => {
          commit('setSavedRows')
          commit('setSaving', false)
        })
    },
  },
})

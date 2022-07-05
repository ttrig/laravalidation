import { reactive } from 'vue'

export const store = reactive({
  rows: [],
  errors: [],
  useMiddleware: true,

  postData() {
    let data = {}
    let filtered = _.reject(this.rows, {disabled: true})

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

  addRow(row) {
    if (!row) {
      row = {
        rule: 'required|string',
        value: '',
      }
    }

    row = _.defaults(row, { disabled: false }, { send_value: true });

    let maxId = _.max(_.map(this.rows, 'id')) || 0
    row.id = maxId + 1

    this.rows.push(row)
  },

  deleteRow(rowId) {
    this.rows = _.reject(this.rows, {id: rowId})
  },

  deleteAllRows() {
    this.rows = []
  },

  updateRow(updatedRow) {
    this.rows = this.rows.map(item => {
      if (item.id === updatedRow.id) {
        return updatedRow
      }
      return item
    })
  },

  toggleRowDisabled(toggledRow) {
    this.rows = this.rows.map(item => {
      if (item.id === toggledRow.id) {
        toggledRow.disabled = !toggledRow.disabled
        return toggledRow
      }
      return item
    })
  },

  toggleRowSendValue(toggledRow) {
    this.rows = this.rows.map(item => {
      if (item.id === toggledRow.id) {
        toggledRow.send_value = !toggledRow.send_value
        return toggledRow
      }
      return item
    })
  },

  nullRowValue(row) {
    this.rows = this.rows.map(item => {
      if (item.id === row.id) {
        row.value = null
        return row
      }
      return item
    })
  },

  toggleMiddleware(bool) {
    this.useMiddleware = bool
  },

  validate() {
    let url = '/api/validate'

    if (! this.useMiddleware) {
      url += '?disable-middleware'
    }

    axios.post(url, this.postData())
        .then(() => this.errors = [])
        .catch(error => this.errors = error.response.data.errors)
  }
})

/* eslint-env node */
module.exports = {
  root: true,
  'extends': [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
    'plugin:@typescript-eslint/recommended'
  ],
  parser: 'vue-eslint-parser', // Add this line
  parserOptions: {
    parser: '@typescript-eslint/parser', // Modify this line
    ecmaVersion: 'latest',
    sourceType: 'module' 
  },
  plugins: [
    '@typescript-eslint',
    'vue' // Add this line
  ]
}
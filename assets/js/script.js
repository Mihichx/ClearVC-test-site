/**
 * Расширенная заглушка-модуль "Калькулятор"
 * Работает как в консоли, так и создает UI при подключении в браузер.
 */

// 1. Объект с математической логикой
const Calculator = {
    add: (a, b) => a + b,
    subtract: (a, b) => a - b,
    multiply: (a, b) => a * b,
    divide: (a, b) => {
        if (b === 0) {
            console.error("Ошибка: Деление на ноль!");
            return "Ошибка";
        }
        return a / b;
    },
    
    // Метод для быстрого тестирования в консоли
    test() {
        console.log("--- Тестирование калькулятора ---");
        console.log(`5 + 3 = ${this.add(5, 3)} (Ожидается: 8)`);
        console.log(`10 - 4 = ${this.subtract(10, 4)} (Ожидается: 6)`);
        console.log(`6 * 7 = ${this.multiply(6, 7)} (Ожидается: 42)`);
        console.log(`12 / 3 = ${this.divide(12, 3)} (Ожидается: 4)`);
        console.log(`5 / 0 = ${this.divide(5, 0)} (Ожидается: Ошибка)`);
        console.log("--------------------------------");
    }
};

// 2. Автоматический запуск тестов при загрузке
console.log("🧮 Заглушка калькулятора успешно подключена!");
Calculator.test();

// 3. Создание визуального интерфейса (UI) прямо из JS
(function createCalculatorUI() {
    // Ждем полной загрузки DOM, если скрипт подключен в head
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initUI);
    } else {
        initUI();
    }

    function initUI() {
        // Проверяем, есть ли уже контейнер на странице, чтобы не дублировать
        if (document.getElementById("calc-container")) return;

        // Создаем контейнер для калькулятора
        const container = document.createElement("div");
        container.id = "calc-container";
        container.style = `
            border: 2px solid #333;
            border-radius: 8px;
            padding: 15px;
            width: 250px;
            background: #f9f9f9;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin: 20px auto;
            text-align: center;
        `;

        // Заголовок
        const title = document.createElement("h3");
        title.innerText = "Калькулятор (Заглушка)";
        title.style.margin = "0 0 10px 0";
        container.appendChild(title);

        // Инпуты для чисел
        const num1 = createInput("Число 1");
        const num2 = createInput("Число 2");
        container.appendChild(num1);
        container.appendChild(num2);

        // Блок для кнопок операций
        const actionsBlock = document.createElement("div");
        actionsBlock.style.margin = "10px 0";
        
        const operations = [
            { sign: "+", name: "add" },
            { sign: "-", name: "subtract" },
            { sign: "*", name: "multiply" },
            { sign: "/", name: "divide" }
        ];

        // Поле вывода результата
        const resultView = document.createElement("div");
        resultView.style = "font-weight: bold; margin-top: 10px; font-size: 1.1em; color: #333;";
        resultView.innerText = "Результат: -";

        // Создаем кнопки и вешаем события
        operations.forEach(op => {
            const btn = document.createElement("button");
            btn.innerText = op.sign;
            btn.style = "width: 40px; height: 40px; margin: 0 5px; cursor: pointer; font-size: 1.2em;";
            btn.onclick = () => {
                const val1 = parseFloat(num1.value);
                const val2 = parseFloat(num2.value);

                if (isNaN(val1) || !num1.value || isNaN(val2) || !num2.value) {
                    resultView.innerText = "Введите оба числа!";
                    resultView.style.color = "red";
                    return;
                }

                resultView.style.color = "#333";
                const res = Calculator[op.name](val1, val2);
                resultView.innerText = `Результат: ${res}`;
            };
            actionsBlock.appendChild(btn);
        });

        container.appendChild(actionsBlock);
        container.appendChild(resultView);

        // Добавляем готовый калькулятор на страницу (в конец body)
        document.body.appendChild(container);
    }

    function createInput(placeholder) {
        const input = document.createElement("input");
        input.type = "number";
        input.placeholder = placeholder;
        input.style = "width: 90%; padding: 5px; margin: 5px 0; box-sizing: border-box;";
        return input;
    }
})();

// Экспортируем объект для возможности использования в модулях (Node.js / ES6)
if (typeof module !== "undefined" && module.exports) {
    module.exports = Calculator;
}

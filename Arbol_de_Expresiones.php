<?php
class NodoExpresion {
    public $valor;
    public $izquierdo, $derecho;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->izquierdo = null;
        $this->derecho = null;
    }
}

// Función para construir un árbol de expresiones
function construirArbolExpresion($expresion) {
    $tokens = explode(" ", $expresion);
    $pila = [];

    foreach ($tokens as $token) {
        // Si el token es un número, creamos un nodo con ese valor
        if (is_numeric($token)) {
            $nodo = new NodoExpresion($token);
            array_push($pila, $nodo);
        } else {
            // Si el token es un operador, construimos un nodo con el operador y los operandos de la pila
            $nodo = new NodoExpresion($token);
            $nodo->derecho = array_pop($pila);
            $nodo->izquierdo = array_pop($pila);
            array_push($pila, $nodo);
        }
    }

    // Al final, la pila contendrá el árbol de expresiones completo
    return array_pop($pila);
}

// Función para evaluar un árbol de expresiones
function evaluarExpresion($raiz) {
    if ($raiz->valor == '+') {
        return evaluarExpresion($raiz->izquierdo) + evaluarExpresion($raiz->derecho);
    } elseif ($raiz->valor == '-') {
        return evaluarExpresion($raiz->izquierdo) - evaluarExpresion($raiz->derecho);
    } elseif ($raiz->valor == '*') {
        return evaluarExpresion($raiz->izquierdo) * evaluarExpresion($raiz->derecho);
    } elseif ($raiz->valor == '/') {
        return evaluarExpresion($raiz->izquierdo) / evaluarExpresion($raiz->derecho);
    } else {
        // Si el nodo es un número, simplemente devolvemos su valor
        return $raiz->valor;
    }
}

// Expresión matemática: (3 + 5) * 2
$expresion = "3 5 + 2 *";

// Construir el árbol de expresiones
$raizExpresion = construirArbolExpresion($expresion);

// Evaluar la expresión
$resultado = evaluarExpresion($raizExpresion);

// Imprimir el resultado
echo "Resultado de la expresión: " . $resultado;
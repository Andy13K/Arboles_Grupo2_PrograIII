<?php
class Nodo {
    public $valor;
    public $izquierdo, $derecho;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->izquierdo = null;
        $this->derecho = null;
    }
}

// Función para insertar un nuevo nodo en el árbol
function insertar($raiz, $valor) {
    if ($raiz === null) {
        // Si la raíz es nula, creamos un nuevo nodo
        return new Nodo($valor);
    }

    // Si el valor es menor, lo insertamos en el subárbol izquierdo
    if ($valor < $raiz->valor) {
        $raiz->izquierdo = insertar($raiz->izquierdo, $valor);
    }
    // Si el valor es mayor, lo insertamos en el subárbol derecho
    elseif ($valor > $raiz->valor) {
        $raiz->derecho = insertar($raiz->derecho, $valor);
    }

    return $raiz;
}

// Función para imprimir en orden un árbol binario
function imprimirEnOrden($raiz) {
    if ($raiz !== null) {
        // Imprimimos en orden: izquierdo, raíz, derecho
        imprimirEnOrden($raiz->izquierdo);
        echo $raiz->valor . " ";
        imprimirEnOrden($raiz->derecho);
    }
}

// Uso del árbol binario
$raiz = null;

// Insertamos algunos valores en el árbol
$raiz = insertar($raiz, 10);
$raiz = insertar($raiz, 5);
$raiz = insertar($raiz, 15);

// Imprimir el árbol en orden
echo "Árbol en orden: ";
imprimirEnOrden($raiz);
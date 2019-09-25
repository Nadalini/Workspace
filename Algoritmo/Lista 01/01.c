#include <stdio.h>
#include <stdlib.h>

// Protótipo de Funções
int *alocarVetor(int n);
int **alocarMatriz(int l, int c);

void preencherVetor(int n, int *v);
void preencherMatriz(int l, int c, int **m, int *v);

void imprimirVetor(int n, int *v);
void imprimirMatriz(int l, int c, int **m);

int main()
{
    int l, c, *vetor, **matriz;

    printf("\nDigite um numero 'l' de linhas: ");
    scanf("%d", &l);
    printf("\nAgora digite um numero 'c' de colunas: ");
    scanf("%d", &c);

    // Alocação de memória para o Vetor e Matriz
    vetor = alocarVetor(l * c);
    matriz = alocarMatriz(l, c);

    // (A) Preenche o vetor V
    printf("\nPreencha o vetor V[%d]:\n", l * c);
    preencherVetor(l * c, vetor);

    // (B) Imprimir o vetor V
    printf("\nVetor V[%d]:\n", l * c);
    imprimirVetor(l * c, vetor);

    // (C) Preencher a matriz M
    printf("\n\nPreenchendo a matriz M[%d][%d]...\n", l, c);
    preencherMatriz(l, c, matriz, vetor);

    // (D) Imprimir o matriz M
    printf("\nMatriz M[%d][%d]:\n", l, c);
    imprimirMatriz(l, c, matriz);

    // Desaloca memória
    free(vetor);
    free(*matriz);

    system("pause");
    return 0;
}

int *alocarVetor(int n)
{
    int *v;

    v = (int *)malloc(n * sizeof(int));

    if (v == NULL)
    {
        printf("Memoria Insuficiente!");
    }

    return v;
}

int **alocarMatriz(int l, int c)
{
    int **m;

    m = (int **)malloc(l * sizeof(int *));

    if (m == NULL)
    {
        printf("Memoria Insuficiente!");
    }

    for (int i = 0; i < l; i++)
    {
        m[i] = (int *)malloc(c * sizeof(int));
        if (m[i] == NULL)
        {
            printf("Memoria Insuficiente");
        }
    }

    return m;
}

void preencherVetor(int n, int *v)
{
    for (int i = 0; i < n; i++)
    {
        scanf("%d", &v[i]);
    }
}

void preencherMatriz(int l, int c, int **m, int *v)
{
    int k = 0;
    for (int i = 0; i < l; i++)
    {
        for (int j = 0; j < c; j++)
        {
            m[i][j] = v[k];
            k++;
        }
    }
}

void imprimirVetor(int n, int *v)
{
    for (int i = 0; i < n; i++)
    {
        printf("%d ", v[i]);
    }
}

void imprimirMatriz(int l, int c, int **m)
{
    for (int i = 0; i < l; i++)
    {
        for (int j = 0; j < c; j++)
        {
            printf("%d ", m[i][j]);
        }
        printf("\n");
    }
    printf("\n");
}
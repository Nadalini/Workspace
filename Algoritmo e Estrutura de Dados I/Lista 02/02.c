#include <stdio.h>
#include <stdlib.h>

float **cria(int n);
void atribui(int i, int j, float x);
float acessa(int i, int j);
void libera(int n, float **mat);

int main()
{
    int n, i, j;
    float **mat, x;

    printf("Digite o valor 'n' para largura e altura da matriz: ");
    scanf("%d", &n);

    mat = cria(n);

    do
    {
        printf("Atribuir valor a um elemento\n");
        printf("Digite a linha: ");
        scanf("%d", &i);
        printf("Digite a coluna: ");
        scanf("%d", &j);
        printf("Digite o valor: ");
        scanf("%d", &x);
    } while (i >= j);
    atribui(i, j, x);

    printf("Acessar valor de um elemento\n");
    printf("Digite a linha: ");
    scanf("%d", &i);
    printf("Digite a coluna: ");
    scanf("%d", &j);
    acessa(i, j);

    libera(n, mat);

    system("pause");
    return 0;
}

float **cria(int n)
{
    int **m;

    m = (int **)malloc(n * sizeof(int *));

    if (m == NULL)
    {
        printf("Memoria Insuficiente!");
    }

    for (int i = 0; i < n; i++)
    {
        m[i] = (int *)malloc(n * sizeof(int));
        m[i] = 0;
        if (m[i] == NULL)
        {
            printf("Memoria Insuficiente");
        }
    }

    return m;
}

void atribui(int i, int j, float x)
{
}

float acessa(int i, int j)
{
}

void libera(int n, float **mat)
{
    free(*mat);
}
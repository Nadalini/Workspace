#include <stdio.h>
#include <stdlib.h>

float *alocarVetor(int n);
void preencherVetor(int n, float *v);
void imprimirVetor(int n, int *v);
float *reverso(int n, float *v);

int main(void)
{
  int n;
  float *v;

  printf("Digite um tamanho para o Vetor: ");
  scanf("%d", &n);
  v = alocarVetor(n);

  printf("\nPreencha o Vetor de %d elementos: \n", n);
  preencherVetor(n, v);

  v = reverso(n, v);

  printf("\nVetor V[%d]:\n", n);
  imprimirVetor(n, v);

  free(v);

  system("pause");
  return 0;
}

float *alocarVetor(int n)
{
  float *v;
  v = (float *)malloc(n * sizeof(int));

  if (v == NULL)
  {
    printf("Memória insuficiente!\n");
  }
  else
  {
    printf("Vetor alocado!\n");
  }

  return v;
}

void preencherVetor(int n, float *v)
{
  for (int i = 0; i < n; i++)
  {
    scanf("%f", &v[i]);
  }
}

float *reverso(int n, float *v)
{
  float *vetor;
  vetor = alocarVetor(n);

  int j = 0;

  for (int i = n; i > 0; n--)
  {
    vetor[j] = v[i];
    j++;
  }

  return vetor;
}

void imprimirVetor(int n, int *v)
{
  for (int i = 0; i < n; i++)
  {
      printf("%d ", v[i]);
  }
}
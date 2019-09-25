#include <stdio.h>
#include <stdlib.h>
#include <locale.h>

int mdc(int x, int y);

int main(){
    setlocale(LC_ALL, "Portuguese");
    int x, y, s;
    printf("Digite um número: ");
    scanf("%d", &x);
    printf("Digite um número: ");
    scanf("%d", &y);

    s = mdc(x, y);

    printf("MDC de %d e %d é %d", x, y, s);
}

int mdc(int x, int y)
{
    if (x % y == 0)
    {
        return y;
    }
    else
    {
        return mdc(y, x % y);
    }
}
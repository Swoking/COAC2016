#include "addcarte.h"

AddCarte::AddCarte(COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);
}
